
# Bool contiene los valores de True y False
# Los tipos numéricos, es false para el 0 (cero), true para los demas valores
valor = 0
resultado = bool(valor)
print(f'valor: {valor}, Resultado: {resultado}')

valor = 0.1
resultado = bool(valor)
print(f'valor: {valor}, Resultado: {resultado}')

#Tipo String -> False '', True demás valores
valor = ''
resultado = bool(valor)
print(f'valor: {valor}, Resultado: {resultado}')

valor = 'Hola'
resultado = bool(valor)
print(f'valor: {valor}, Resultado: {resultado}')

#Tipo colecciones -> False para colecciones vacias
#Tipo colecciones -> True para todas las demas
#Lista
valor = []
resultado = bool(valor)
print(f'valor: {valor}, Resultado: {resultado}')

#Tupla
valor = (5,)
resultado = bool(valor)
print(f'valor de una tupla vacía: {valor}, Resultado: {resultado}')

valor = (5,)
resultado = bool(valor)
print(f'valor de una tupla con elementos: {valor}, Resultado: {resultado}')

#Diccionario
valor = {}
resultado = bool(valor)
print(f'valor de un diccionario vacio : {valor}, Resultado: {resultado}')

valor = {'Nombre': 'Juan', 'Apellido': 'Perez'}
resultado = bool(valor)
print(f'valor de un diccionario vacio : {valor}, Resultado: {resultado}')

#Sentencias de control con bool
if (1,):
    print('Regreso verdadero')
else:
    print('Regreso falso')

#Ciclos
variable = 17
while variable:
    print('Regresa verdadero')
    break
else:
    print('Regresa falso')


