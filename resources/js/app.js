import mqtt from 'mqtt';

// Usaremos o broker da EMQX que é mais estável para evitar erros de conexão
const brokerUrl = 'ws://broker.emqx.io:8083/mqtt';

console.log('🔌 Tentando conectar ao Broker MQTT...');

const client = mqtt.connect(brokerUrl);
const topicoMonitoramento = 'monitoramento/teste/laravel';

client.on('connect', () => {
    console.log('✅ Conectado ao MQTT com sucesso!');
    
    client.subscribe(topicoMonitoramento, (err) => {
        if (!err) {
            console.log(`📡 Inscrito com sucesso no tópico: ${topicoMonitoramento}`);
        }
    });
});

client.on('message', (topic, message) => {
    const dadosRecebidos = message.toString();
    console.log(`📩 Nova mensagem recebida [${topic}]:`, dadosRecebidos);
    
    // Alerta temporário na tela para você ver funcionar sem precisar abrir o console
    alert("Dados recebidos do MQTTX: " + dadosRecebidos);
});

client.on('error', (err) => {
    console.error('❌ Erro na conexão MQTT:', err);
});
