FROM node:20-alpine
WORKDIR /usr/src/app
COPY package*.json ./
COPY /frontend/entrypoint.sh /usr/scripts/entrypoint.sh
RUN chmod +x /usr/scripts/entrypoint.sh
EXPOSE 5173
CMD ["/usr/scripts/entrypoint.sh"]
