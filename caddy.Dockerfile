ARG CADDY_VERSION=2.7
FROM caddy:${CADDY_VERSION}-alpine

# Copy the config
COPY Caddyfile /etc/caddy/Caddyfile

# Copy public files
COPY public/* ./
