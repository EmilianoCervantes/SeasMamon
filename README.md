# SeasMamon - Blockchain multicase Implementation
Hack Mty - August 26 - 27 - Blockchains
 
#### ¿Que es Blockchain?
[Definición IBM](https://developer.ibm.com/courses/all/blockchain-essentials/) : Blockchain es una registro de transaciones seguro, distruibuido en el cual se comparten procesos del sistema. 

#### Derechos de Autor

El codigo de blockchain presentado a continuación es una adaptación de [naivechain](https://github.com/lhartikk/naivechain) escrito por Lauri Hartikka. Cualquier pregunta por favor referirse a el. 

#### Conceptos basicos del sistema

* Utiliza un interfaz HTTP para controlar los bloques
* Utilizar Websockets para comunicarse con otros nodos (P2P)
* Los datos son almacenados en la sesión
* No existe proof-of-work toda la validación la hace el dueño de los datos
* Interface para moviles para autorizar el acceso a los datos
* Interface web para visualizar todos los datos
* Capacidad de rencyptar los datos, para prohibir los accesos

![alt tag](naivechain_blockchain.png)

![alt tag](naivechain_components.png)

#### Requisitos

* Node-JS 4.15 o mayor
* NPM 5.3.0 o mayor
* PHP 7.x
* Nginx, XAMP, WAMP, Apache
* Android 5.x
* Conexión local a todos los dispositivos involucrados

#### Como empezar
(Para prubas locales)
```
npm install
HTTP_PORT=3001 P2P_PORT=6001 npm start //Esto hace que tu computadora se convierta en oyente
HTTP_PORT=3002 P2P_PORT=6002 PEERS=ws://localhost:6001 npm start //Esto simula un nodo adicional
```

#### Agregar un archivo

```
curl -H "Content-type:application/json" --data '{"id": "{HASH identificador del cliente}", "data" : "Mi primer bloque"}' http://localhost:3001/mineBlock
```

#### Rencryptar datos

```
curl -H "Content-type:application/json" --data '{"id": "{Hash identificador del cliente}", "hash" : "Secret que lanzo la ultima transacción"}' http://localhost:3001/editBlock
```

#### Ver todos los bloques (encryptados)

```
curl http://localhost:3001/blocks
```

#### Ver la longitud del blockchain

```
curl http://localhost:3001/getBlockCount
```

#### Agregar a otro participante

```
curl -H "Content-type:application/json" --data '{"peer" : "ws://{IP Local del Usuario}:6001"}' http://localhost:3001/addPeer
```

#### Conseguir el ultimo bloque agregado por un usuario

```
curl -H "Content-type:application/json" --data '{"id" : "{Hash identificador del cliente}"}' http://localhost:3001/getBlock```