# CSS GRID

## GRID

- Bidimensional
- Divisão de toda a página em linhas e colunas
- Colocar elementos onde quiser nessa divisão

## GRID OU FLEXBOX
- Grid: Duas dimensões (colunas e linhas)
- Flexbox: Uma dimensão (ou coluna ou linha)
- Um complementa o trabalho do outro
- Verificar quais navegadores ainda não estão aceitando o Grid

---

## PROPRIEDADES

Vamos separar em 2 grupos:
`container` e `item(s)`

### CONTAINER

- display: grid;
- grid-template-colums;
- grid-template-rows;
- grid-gap
    - grid-row-gap
    - grid-column-gap
- grid-template-areas;

... e mais 4 propriedades de **alinhamento**

### ITENS(s)

- grid-column
    - grid-column-start;
    - grid-colum-end;
- grid-row
    - grid-row-start
    - grid-row-gap
- grid-area;

... e mais 2 propriedades de **alinhamento**

## GRID: ALINHAMENTO

Existem 6 propriedades para alinhamento:
1. `justify-content`
2. `align-content`
3. `justify-items`
4. `aling-items`
5. `justify-self`
6. `aling-self`

Vamos separá-los em 2 grupos
1. `justify` e `align`
2. `content`, `items` e `self`

## JUSTIFY e ALIGN

Sabendo que o grid é bidimensional, nós temos o eixo x e o y.

O **eixo X** é o posicionamento horizontal, da esquerda para a direita.

O **eixo Y** é o posicionamento vertical, de cima para baixo.

## CONTENT, ITEMS e SELF

Juntando o `justify`, ou `aling`, com esses elementos: `content`, `items` e `self`; nós observamos nossas propriedades

### CONTENT

`justify-content` e `aling-content` nos permite alinhar o próprio grid, relativo ao espaço fora do grid.

O uso dessas propriedases são raras, pois só é aplicado caso o grid seja menor que a área definida. (Por exemplo, quando usamos em px o tamanho do grid, podemos terminar com um grid pequeno, para o tamanho da área do grid)

Podemos usar **7 valores**:
1. start
2. end
3. center
4. stretch
5. space-between
6. space-around
7. space-evenly

### ITEMS

`justify-items` e `align-items` vai permitir alinhar os itens do nosso grid, em qualquer espaço disponível, na célula que ele habitar.

Podemos usar **4 valores**:
1. start
2. end
3. center
4. stretch

### SELF

`justify-self` `align-self` vai nos permitir alinhar o item em si.

Faz a mesma coisa que o `justify-items` e `aling-items`, porém, aplicado diretamente no item de um grid