
# help(str.split)

cursos = 'Java Javascript Node Python Diseno'
lista_cursos = cursos.split()
print(f'Lista de cursos: {lista_cursos}')
print(type(lista_cursos))

cursos_separadoros_coma = 'Java,Python,Node,Javascript,Spring'
listar_cursos = cursos_separadoros_coma.split()
print(f'Lista de cursos: {listar_cursos}')
print(len(listar_cursos))