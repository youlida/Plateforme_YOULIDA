import './bootstrap';
import React from 'react';
import ReactDOM from 'react-dom/client';
import App from './react/App';
import 'bootstrap/dist/css/bootstrap.min.css';
import '@fortawesome/fontawesome-free/css/all.min.css';

const el = document.getElementById('react-app');
if (el) {
    ReactDOM.createRoot(el).render(
        <React.StrictMode>
            <App />
        </React.StrictMode>
    );
}