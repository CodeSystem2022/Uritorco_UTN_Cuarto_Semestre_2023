# String Inmutables

# help(str.capitalize) # cambia el primer caracter a mayúscula

mensaje1 = "Hola a todxs"
mensaje2 = mensaje1.capitalize() # debería poner la H en mayúscula pero NO la modifica
# crea una nueva cadena con un nuevo mensaje. No incide en el mensaje2

print(f'Mensaje1: {mensaje1}, id: {id(mensaje1)}') # id de la variable
print(f'Mensaje2: {mensaje2}, id: {id(mensaje2)}') # id diferente son dos objetos separados

mensaje1 += ' Adiós' # nueva cadena
print(f'Mensaje1: {mensaje1}, id: {id(mensaje1)}') # muestra el id de la nueva cadena