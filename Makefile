.PHONY: init
init:
	cd $(PWD)/docker && \
	docker-compose up -d --build && \
	docker exec -it php-skl fish

.PHONY: restart
restart:
	cd $(PWD)/docker && \
	docker-compose up -d --force-recreate && \
	docker exec -it php-skl fish



