up:
	docker compose up --build -d
seed:
	docker exec -i $$(docker ps -qf "name=db") mysql -uroot -prootpass epss2 < sql/install.sql || true
