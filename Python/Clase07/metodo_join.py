# help(str.join)

tupla_str = ('Hola', 'alumnos', 'Tecnicatura', 'Universitaria') # tupla con 4 elementos
mensaje = ' '.join(tupla_str) # crea una nueva cadena
print(f'Mensaje: {mensaje}') # devuelve 1 cadena sola

lista_cursos = ['Java', 'Python', 'Angular', 'Spring']
mensaje = ', '.join(lista_cursos)
print(f'Mensaje: {mensaje}')

cadena = 'HolaMundo'
mensaje = '.'.join(cadena)
print(f'Mensaje: {mensaje}')

diccionario = {'nombre': 'Juan', 'apellido': 'Perez', 'edad': '20'}
llaves = '-'.join(diccionario.keys())
valores = '-'.join(diccionario.values())
print(f'Llaves: {llaves}, Type: {type(llaves)}')
print(f'Valores: {valores}, Type: {type(valores)}')