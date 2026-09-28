# portainer

    docker swarm init --advertise-addr 192.168.0.95
    docker stack deploy -c portainer.yml portainer
    Acessar: http://192.168.0.95:9000/

    senha: portainer-agent-stack

    docker stack rm portainer
    docker volume rm portainer_portainer_data

# Após a criação do container Garage

    docker compose exec garage /garage status

# Copie o ID do Nó (string longa) que aparecer na saída.
# Substitua <NODE_ID> pelo ID que você copiou:

    docker compose exec garage /garage layout assign -z dc1 -c 1G <NODE_ID>
    docker compose exec garage /garage layout apply --version 1

# Criar a chave de acesso e o bucket de teste
# 1. Criar a chave
    docker compose exec garage /garage key create bucket-teste-key
# 2. Criar o bucket
    docker compose exec garage /garage bucket create bucket-teste
# 3. Dar permissões à chave no bucket
    docker compose exec garage /garage bucket allow --read --write --owner bucket-teste --key bucket-teste-key
