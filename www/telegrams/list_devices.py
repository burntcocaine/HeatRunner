from xknx import XKNX
from xknx.io import ConnectionConfig, ConnectionType
import asyncio
import logging

# Configurar el registro de logs
logging.basicConfig(level=logging.INFO, format='%(asctime)s - %(levelname)s - %(message)s')

async def main():
    xknx = XKNX()

    connection_config = ConnectionConfig(
        connection_type=ConnectionType.TUNNELING,
        gateway_ip='192.168.1.25',  # Cambia esto por la IP de tu pasarela KNX
        gateway_port=3671,
        local_ip='192.168.1.10'  # Asegúrate de que esta es la IP local de tu máquina
    )

    try:
        await xknx.start()
        await xknx.connection_manager.connect(connection_config)
        logging.info("Conexión establecida con la pasarela KNX")

        logging.info("Dispositivos KNX encontrados:")
        for device in xknx.devices:
            logging.info(f"- {device}")

    except Exception as ex:
        logging.error(f"Error: {ex}")

    finally:
        await xknx.stop()
        logging.info("Conexión cerrada con la pasarela KNX")

if __name__ == "__main__":
    asyncio.run(main())
