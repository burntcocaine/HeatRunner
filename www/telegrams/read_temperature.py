from xknx import XKNX
from xknx.io import ConnectionConfig, ConnectionType
from xknx.devices import TemperatureSensor
import asyncio

async def main():
    xknx = XKNX()

    connection_config = ConnectionConfig(
        connection_type=ConnectionType.TUNNELING,
        gateway_ip='192.168.1.135',  # Cambia esto por la IP de tu pasarela KNX a IP
        gateway_port=3671
    )

    sensor = TemperatureSensor(
        xknx,
        name='Temperatura Real',
        group_address_state='1/0/100'
    )

    await xknx.start(connection_config)

    await sensor.sync()
    print(f'Temperatura Real: {sensor.temperature} °C')

    await xknx.stop()

import asyncio
asyncio.run(main())
