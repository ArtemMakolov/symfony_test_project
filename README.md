Гайд как развернуть проект, можно и не разворачивать, так как код можно сказать не рабочий, просто пример архитектурного решения:


0) cp .env.example .env
1) cd docker
Если будет ошибка по volume: docker volume create --name=backend-postgres-data
2) docker-compose up
3) http://localhost:2860/api/doc
