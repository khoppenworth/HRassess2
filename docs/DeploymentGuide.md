# Deployment Guide
1. Create DB and user; update `config.php`.
2. Upload files; set docroot to repo root or to `public/`.
3. Run `/install.php` once.
4. Optional AdminLTE: drop into `public/vendor/adminlte/`.
5. Create API token: `INSERT INTO api_tokens (token,label) VALUES ('changeme_token_123','looker');`
6. BI endpoints: `/api/export/assessments.csv.php`, `/api/export/assessments.json.php`.
