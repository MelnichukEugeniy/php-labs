<?php

class MotorcycleController extends PageController
{
    private PDO $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = Database::getInstance();
    }

    public function action_list(): void
    {
        $stmt = $this->db->query('SELECT * FROM motorcycles ORDER BY id DESC');
        $motorcycles = $stmt->fetchAll();

        $this->render('motorcycle/list', [
            'motorcycles' => $motorcycles,
        ], 'Каталог мотоциклів');
    }

    public function action_create(): void
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('auth/login');
            return;
        }

        $errors = [];
        $old = [];

        if ($this->request->isPost()) {
            $old = $this->request->allPost();
            $errors = $this->validate($old);

            if (empty($errors)) {
                $stmt = $this->db->prepare(
                    'INSERT INTO motorcycles (model, brand, category, price, engine_cc, power_hp, description)
                     VALUES (:model, :brand, :category, :price, :engine_cc, :power_hp, :description)'
                );
                $stmt->execute([
                    ':model' => trim($old['model']),
                    ':brand' => trim($old['brand'] ?? ''),
                    ':category' => trim($old['category'] ?? ''),
                    ':price' => (int)($old['price'] ?? 0),
                    ':engine_cc' => (int)($old['engine_cc'] ?? 0),
                    ':power_hp' => (int)($old['power_hp'] ?? 0),
                    ':description' => trim($old['description'] ?? ''),
                ]);

                $_SESSION['flash_success'] = 'Мотоцикл "' . trim($old['model']) . '" додано!';
                $this->redirect('motorcycle/list');
                return;
            }
        }

        $this->render('motorcycle/create', [
            'errors' => $errors,
            'old' => $old,
        ], 'Додати мотоцикл');
    }

    public function action_edit(): void
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('auth/login');
            return;
        }

        $id = (int)$this->request->get('id', 0);

        if ($id <= 0) {
            $this->redirect('motorcycle/list');
            return;
        }

        $stmt = $this->db->prepare('SELECT * FROM motorcycles WHERE id = :id');
        $stmt->execute([':id' => $id]);
        $motorcycle = $stmt->fetch();

        if (!$motorcycle) {
            $this->redirect('motorcycle/list');
            return;
        }

        $errors = [];

        if ($this->request->isPost()) {
            $data = $this->request->allPost();
            $errors = $this->validate($data);

            if (empty($errors)) {
                $stmt = $this->db->prepare(
                    'UPDATE motorcycles SET model = :model, brand = :brand, category = :category,
                     price = :price, engine_cc = :engine_cc, power_hp = :power_hp, description = :description WHERE id = :id'
                );
                $stmt->execute([
                    ':model' => trim($data['model']),
                    ':brand' => trim($data['brand'] ?? ''),
                    ':category' => trim($data['category'] ?? ''),
                    ':price' => (int)($data['price'] ?? 0),
                    ':engine_cc' => (int)($data['engine_cc'] ?? 0),
                    ':power_hp' => (int)($data['power_hp'] ?? 0),
                    ':description' => trim($data['description'] ?? ''),
                    ':id' => $id,
                ]);

                $_SESSION['flash_success'] = 'Мотоцикл оновлено!';
                $this->redirect('motorcycle/list');
                return;
            }

            $motorcycle = array_merge($motorcycle, $data);
        }

        $this->render('motorcycle/edit', [
            'motorcycle' => $motorcycle,
            'errors' => $errors,
        ], 'Редагувати мотоцикл');
    }

    public function action_delete(): void
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('auth/login');
            return;
        }

        if ($this->request->isPost()) {
            $id = (int)$this->request->post('id', 0);

            if ($id > 0) {
                $stmt = $this->db->prepare('DELETE FROM motorcycles WHERE id = :id');
                $stmt->execute([':id' => $id]);
                $_SESSION['flash_success'] = 'Мотоцикл видалено!';
            }
        }

        $this->redirect('motorcycle/list');
    }

    private function validate(array $data): array
    {
        $errors = [];

        if (trim($data['model'] ?? '') === '') {
            $errors['model'] = 'Модель мотоцикла є обов\'язковою.';
        }

        if (trim($data['brand'] ?? '') === '') {
            $errors['brand'] = 'Марка є обов\'язковою.';
        }

        $price = $data['price'] ?? '';
        if ($price !== '' && (!is_numeric($price) || (int)$price < 0)) {
            $errors['price'] = 'Ціна має бути додатнім числом.';
        }

        $cc = $data['engine_cc'] ?? '';
        if ($cc !== '' && (!is_numeric($cc) || (int)$cc < 0)) {
            $errors['engine_cc'] = 'Об\'єм двигуна має бути додатнім числом.';
        }

        $hp = $data['power_hp'] ?? '';
        if ($hp !== '' && (!is_numeric($hp) || (int)$hp < 0)) {
            $errors['power_hp'] = 'Потужність має бути додатнім числом.';
        }

        return $errors;
    }
}
