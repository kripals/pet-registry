FROM node:23.6.1-alpine

# Set working directory
WORKDIR /app

# Copy package.json
COPY ./frontend/package.json ./

# Install dependencies
RUN npm install

# Copy project files
COPY . .

# Expose port
EXPOSE 5173

# Serve the Vue app
CMD ["npm", "run", "serve"]