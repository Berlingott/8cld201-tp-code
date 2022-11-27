FROM node:15
WORKDIR /app
COPY package.json .
RUN npm install
RUN npm install mongoose
RUN npm install express
RUN npm install bcryptjs
COPY . ./
ENV PORT 3000
EXPOSE $PORT
CMD ["npm", "run", "dev"]