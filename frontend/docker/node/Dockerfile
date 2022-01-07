FROM node:14.15.4-alpine

WORKDIR /app

COPY ./frontend/package*.json .

RUN npm install

COPY ./frontend .

CMD ["npm", "start"]