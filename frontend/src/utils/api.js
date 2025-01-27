const API_URL = import.meta.env.VITE_API_URL;

export async function apiFetch(endpoint, method = 'GET', options = {}) {
    const token = localStorage.getItem('token'); // taking the local storage token

    const headers = {
        'Content-Type': 'application/json',
        ...options.headers,
    };

    if (token) {
        headers['Authorization'] = `Bearer ${token}`;
    }
    
    const response = await fetch(`${API_URL}${endpoint}`, {
        method,
        ...options,
        headers,
    });

    if (response.status === 401) {
        // Token has expired, clear the token and treat as logged out
        localStorage.removeItem('token');
        alert('Session has expired. Please log in again.');
        // redirect to the login page
        window.location.href = '/login';
        return null;
    }

    if (!response.ok) {
        throw new Error('Failed to fetch');
    }

    return response.json();
}