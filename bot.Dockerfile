# Use the official image as a parent image
FROM alpine:latest as build

# Set the Workdir
WORKDIR /scrapper

# Copy the requirement file
COPY src/scrapper/ .

# Install Dependencies
RUN apk add --update --no-cache python3 && \
    ln -sf python3 /usr/bin/python && \
    python3 -m ensurepip && \
    pip3 install --no-cache --upgrade pip setuptools && \
    ls -la && \
    ls -la config/ && \
    pwd && \
    pip3 install --requirement requirements.txt

#WORKDIR /app
# Copy the script file
#COPY dev/app .



# Labels and information
LABEL maintainer="Zebra <csousa90@gmail.com>" \
      org.label-schema.vendor="Zebra" \
      org.label-schema.name="TornScrapper" \
      org.label-schema.url="www.carlossousa.tech" \
      org.label-schema.description="A Torn Scrapper, which will find and index player public information for easier target selection."


# Creates a Single Layer Image
# Info: Not possible currently, since the Software is NOT self contained eg:
#FROM scratch
#WORKDIR /app
#COPY --from=build /app .
#WORKDIR /app
ENTRYPOINT ["python3", "-u", "scrapper.py"]
#CMD ["python3", "-u", "scrapper.py"]
