from flask import Flask, jsonify
import asyncio
from xknx import XKNX
from xknx.io import ConnectionConfig, ConnectionType

app = Flask(__name__)

async def get_temperature():
    xknx = XKNX()
    await xknx.start()
    
    connection_config = ConnectionConfig(
        connection_type=ConnectionType.TUNNELING,
        gateway_ip='192.168.1.25'
    )
    
    await xknx.connection_manager.connect(connection_config=connection_config)
    
    # Dirección de grupo para la temperatura
    group_address = "1/0/100"
    response = await xknx.devices[0].read(group_address)
    
    await xknx.stop()
    
    if response:
        return response.value  # Ajusta esto según el tipo de dato esperado
    else:
        return None

@app.route('/get_temperature')
def temperature():
    temp = asyncio.run(get_temperature())
    if temp is not None:
        return jsonify({"temperature": temp})
    else:
        return jsonify({"error": "No se pudo obtener la temperatura"}), 500

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000)
