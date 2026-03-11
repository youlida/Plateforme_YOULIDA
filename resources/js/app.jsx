import './bootstrap';
import React from 'react';
import ReactDOM from 'react-dom/client';
import App from './react/App';

const el = document.getElementById('react-app');
if (el) {
    ReactDOM.createRoot(el).render(
        <React.StrictMode>
            <App />
        </React.StrictMode>
    );
}