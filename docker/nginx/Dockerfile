FROM nginx:mainline

# Config config
COPY .docker/nginx/conf/* /etc/nginx/conf.d/

# Set up stuff
RUN ln -s /usr/share/nginx/storage/app/images /usr/share/nginx/html/images && \
    ln -s /usr/share/nginx/storage/app/upload /usr/share/nginx/html/upload && \
    rm -rf /etc/nginx/conf.d/default.conf && \
    mv /etc/nginx/conf.d/default.conf.tmpl /etc/nginx/conf.d/default.conf

## Entrypoint
#COPY docker/nginx/docker-entrypoint /usr/local/bin/docker-entrypoint
#
#RUN chmod +x /usr/local/bin/docker-entrypoint
#
#ENTRYPOINT ["docker-entrypoint"]
CMD ["nginx", "-g", "daemon off;"]