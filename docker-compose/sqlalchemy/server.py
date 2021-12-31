import socket

sock = socket.socket(socket.AF_INET,socket.SOCK_STREAM)
sock.bind(('', 1234))
sock.listen(1)
conn, addr = sock.accept()

print('connected:', addr)

while True:
    data = conn.recv(1024)
    if not data:
        break
    data_up = data.decode('utf-8').upper()
    data_bytes = data_up.encode('utf-8')
    conn.send(data_bytes)

conn.close()