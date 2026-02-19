# Copilot Instructions for php-labs

This repository contains a collection of **student laboratory exercises** for a PHP course. The code evolves from simple scripts to small MVC frameworks and finally a Laravel starter. As an AI agent you should focus on getting productive within this structure and respecting the conventions used by the instructor.

---
## Big‑picture architecture

- **Root layout**: top level contains `lr1/` through `lr6/` – each directory is a separate lab.
  - `assignment.md` describes the lab content.
  - `demo/` holds the instructor's complete solution or skeleton; treat it as read‑only reference.
  - `variants/` stores markdown files named `v<N>.md` with the problem statements for each student variant.
- **Shared resources** sit under `shared/`:
  - `css/` styles used by all demos.
  - `helpers/` utility scripts (`dev_reload.php`, `test_helper.php`, etc.).
  - `templates/` small view helpers such as `task_cards.php` which builds an HTML index of tasks.
- **Variant files** are plain Markdown; they are parsed by the `validate_uniqueness.php` script and by students when they implement tasks. Each variant includes a numbered list of input/out‑put values.
- **Code style progression**:
  - LR1–LR3: procedural scripts named `taskX_*.php`, usually defining one or two helper functions and echoing results.
  - LR4–LR5: a simple home‑grown MVC framework in `demo/` (`classes/Controller.php`, controllers/views directories). Student tasks should follow the same `index.php` → controller → view flow if they convert to MVC.
  - LR6: the assignment expects a **Laravel** project; there is no sample app in the repo, but the agent should be aware that later work will use Composer, artisan commands, migrations, and Blade templates.
- **Development server**: everything runs on PHP’s built‑in web server (`php -S`). Paths are relative to the repo root. Example: `http://localhost:8000/lr2/demo/` or `.../variants/v1/task1_replace.php`.

## Critical developer workflows

1. **Running the project**
   ```bash
   cd php-labs
   php -S localhost:8000
   # open http://localhost:8000 in browser
   ```
   See `docs/running-project.md` for details (ports, single‑file execution).

2. **Hot reload** is enabled automatically in dev mode (localhost or `PHP_ENV=development`). Demo/layout files include `shared/helpers/dev_reload.php` and call `handleDevReloadRequest()` at the top and `<?= devReloadScript() ?>` before `</body>`.
   - Refer to `docs/DEV_MODE.md` for explanation and configuration.

3. **Checking variant uniqueness**
   ```bash
   php validate_uniqueness.php lr1          # or lr2, lr3...
   php validate_uniqueness.php lr2 --verbose
   ```
   This script scans `lrX/variants` and validates that all vN.md files contain distinct numbers, correct arithmetic, etc. Instructors run it when adding new variants.

4. **Editing/adding variants**
   - Copy an existing `vN.md` and adjust the numbers/text; keep the header (`# Варіант N — Лабораторна робота №M`) and include all sections (`Завдання 1`, …).
   - Do **not** modify other students’ variant files.
   - When adding tasks, match the naming convention `task<number>_desc.php` and update the demo index if necessary.

5. **Using demo code**
   - Demos show the **expected file structure** and often include helper functions, layout HTML, session handling, etc. When implementing student solutions, mimic the demo’s pattern rather than inventing new directories or frameworks unless the lab explicitly requires it (LR6).
   - For example, `lr2/demo/task1_replace.php` defines `findAndReplace()`; student version should be similar.

6. **MVC labs (lr4, lr5)**
   - Controllers live in `demo/controllers/`, each class extending `PageController` (see `classes/Controller.php`). Actions are public methods named after routes.
   - Views are grouped by controller name under `demo/views/` and rendered by `PageView`.
   - The `index.php` router in `demo/` instantiates the appropriate controller based on `$_GET['page']` and calls the method.
   - Student variants should follow this same structure when they switch to MVC. Do not modify the core MVC classes; extend them.

7. **Common patterns & conventions**
   - Task card generation uses `shared/templates/task_cards.php`. Pass an associative array of filenames to labels.
   - Utility scripts like `dev_reload.php` and `test_helper.php` are included with `require_once` using relative paths (`dirname(__DIR__, 2)`) to keep them portable.
   - CSS is centralized under `shared/css/base.css`; demos link to a local copy (e.g. `demo/demo.css` that imports it).
   - Input validation, session/cookie handling and form structure are consistent across tasks; agents should copy the style from demos.
   - File names and variable names use snake_case, comments are mostly in Ukrainian.

8. **Testing & debugging**
   - There are no automated unit tests; manual inspection via web browser is the norm.
   - The `shared/helpers/test_helper.php` may contain functions useful for writing simple asserts when working on tasks; open it when needed.
   - Errors appear either on the page or in the terminal when running `php` commands.

9. **Git & repository conventions**
   - Students are instructed never to modify `shared/`, `demo/`, or variants they don’t own; avoid committing discipline‑breaking edits.
   - Branch naming and commit message format are documented in `docs/acceptance-criteria.md`—the AI agent should mimic those when generating commits.
   - Synchronize with `upstream` remote to fetch instructor updates (see README).

10. **External dependencies & integration points**
    - The only external requirement is PHP itself (and Composer for LR6). No third‑party libraries are stored in the repo.
    - Laravel-specific work (installing via composer, running `artisan serve`, migrating databases) is expected for LR6 and is described in `lr6/assignment.md`.

---
## When writing code as an AI assistant

- **Keep solutions small and focused**; follow the style of the demo or existing student tasks.
- **Do not introduce frameworks or libraries** unless the target lab explicitly requires them (Laravel in LR6). For earlier labs, avoid PSR‑4 autoloaders; use explicit `require_once`.
- **Preserve Ukrainian comments** when editing existing files; new comments may be in English if necessary but concise.
- **Mirror demo logic**: a quick way to generate correct output is to inspect the corresponding file in the `demo/` directory of the same lab and variant.
- **If asked to add tests**, consider writing simple scripts invoking functions and echoing results; the `test_helper.php` file may show examples.
- **Watch paths carefully**: relative includes often use `__DIR__` and double `dirname()` calls. Keep them consistent.
- **For variant parsing/validation**, the Markdown structure is predictable — headings for tasks and bullet lists of parameters. The `validate_uniqueness.php` script shows how to extract numbers, letters, table sizes, etc. Use it as a reference when writing parsers.

---

Any unclear or missing information? Please point out sections of the repository that you think the agent should know but were not covered above. Feedback will help refine these instructions.