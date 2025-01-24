FROM node:23.6.1-alpine

# Set working directory
WORKDIR /app

# Copy package.json and package-lock.json
COPY ./frontend/package*.json ./

# Install dependencies
RUN npm install --save-dev eslint-plugin-vue@^9.0.0
RUN npm install --legacy-peer-deps

# Copy project files
COPY ./frontend ./

# Expose port
EXPOSE 8081

# Serve the Vue app
CMD ["npm", "run", "serve"]