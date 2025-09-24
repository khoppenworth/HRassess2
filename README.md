# HRassess2



How to use



Unzip all four into the same folder, preserving structure (they’re complementary).



Adjust config/config.php with your DB credentials.



Option A (Docker):



docker compose up --build -d

\# In another terminal after DB is up:

make seed





Option B (manual):



Create MySQL DB epss2 and run sql/install.sql then sql/upgrade.sql.



Serve public/ via PHP (e.g., php -S 0.0.0.0:8080 -t public).



Login: use the seeded admin / changeme if/when you seed a full schema; otherwise create a user directly.



If you want me to also include your latest standardized CSVs and the full analytics/IDP features from the pro build inside this split package, say “add pro features to split build” and I’ll regenerate the four ZIPs with those modules wired in.

