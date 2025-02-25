import './bootstrap';
import React from 'react';
import { createRoot } from 'react-dom/client';
import Draw from './Components/draw';

const container = document.getElementById('app');
if (container) {
    const root = createRoot(container);
    root.render(<Draw />);
} else {
    console.error("Container element not found");
}