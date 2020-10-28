# set context on project root!!

FROM nginx:1.19

COPY ./nginx/prd_conf.d /etc/nginx/conf.d

RUN mkdir public
COPY ./code/public /public/
