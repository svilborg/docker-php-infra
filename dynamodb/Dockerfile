FROM openjdk:7

RUN mkdir -p opt/dynamodb
WORKDIR /opt/dynamodb

# Download and unzip dynamodb.
RUN wget http://dynamodb-local.s3-website-us-west-2.amazonaws.com/dynamodb_local_latest.tar.gz -q -O - | tar -xz

ENV JAVA_OPTIONS -Xmx300m
ENV DB_PATH /data

EXPOSE 8000

CMD java $JAVA_OPTIONS -Djava.library.path=./DynamoDBLocal_lib -jar DynamoDBLocal.jar -sharedDb -dbPath ${DB_PATH}
