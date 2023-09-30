import './bootstrap';

import io from 'socket.io-client';

const socket = io('http://192.168.86.207:8000');

socket.on('connect', () => {
  console.log('Socket connected');
});

socket.on('my-event', (data) => {
  console.log('Received event:', data);
});

// Kirim event ke server
socket.emit('my-event', { event: 'my-event', data: 'my-data' });