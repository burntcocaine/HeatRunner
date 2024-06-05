import asyncio
from xknx import XKNX
from xknx.io import ConnectionConfig, ConnectionType

async def get_temperature():
    xknx = XKNX()
    
    connection_config = ConnectionConfig(
        connection_type=ConnectionType.TUNNELING,
        gateway_ip='192.168.1.135:3671'
    )
    
    await xknx.start()
    await xknx.connection_manager.connect(connection_config=connection_config)
    
    # Aquí debes reemplazar el código para obtener la temperatura según el grupo adecuado
    # Este es un ejemplo que podrías necesitar ajustar
    group_address = "1/0/100"  # Dirección de grupo para la temperatura
    response = await xknx.devices.read(group_address)
    
    await xknx.stop()
    
    if response:
        return response.value  # Ajusta esto según el tipo de dato esperado
    else:
        return None

async def main():
    temp = await get_temperature()
    if temp is not None:
        print(f"La temperatura es: {temp}")
    else:
        print("No se pudo obtener la temperatura")

# Ejecutar la función principal
asyncio.run(main())
