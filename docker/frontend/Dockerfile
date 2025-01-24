FROM node:16-alpine

# Set working directory
WORKDIR /app

# Copy package.json and package-lock.json
COPY ./frontend/package.json ./

# Install dependencies
RUN npm install --legacy-peer-deps

# Copy project files
COPY . .

# Expose port
EXPOSE 8081

# Serve the Vue app
CMD ["npm", "run", "serve"]