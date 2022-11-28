FROM gcr.io/stu-serverless/cs-ri-prognose-planung-2023

COPY --chown=www-data:www-data ./src /app
COPY ./@secret_credentials/.env.cloudrun.prod /app/.env

CMD sh /app/docker/startup.sh
