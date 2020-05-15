@ECHO OFF
CLS
ECHO Starting app... Press Ctrl + C to terminate.
CD ./frontend && npm run build && CD ../backend && npm run start


