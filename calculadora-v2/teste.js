function calcularExpressao(expressao) {
    // Substitui a letra "x" pelo operador de multiplicação "*"
    expressao = expressao.replace(/x/g, '*');
  
    // Adiciona um 0 no início da expressão se começar com um sinal de subtração
    if (expressao.startsWith('-')) {
      expressao = '0' + expressao;
    }
  
    // Divide a expressão em números e operadores
    let numeros = expressao.split(/[\+\-\*\/]/g).map(parseFloat);
    let operadores = expressao.match(/[\+\-\*\/]/g);
  
    // Calcula a expressão usando a ordem correta das operações
    for (let i = 0; i < operadores.length; i++) {
      if (operadores[i] === '*' || operadores[i] === '/') {
        let numeroEsquerda = numeros[i];
        let numeroDireita = numeros[i+1];
        let operador = operadores[i];
  
        let resultadoParcial;
        if (operador === '*') {
          resultadoParcial = numeroEsquerda * numeroDireita;
        } else {
          resultadoParcial = numeroEsquerda / numeroDireita;
        }
  
        numeros.splice(i, 2, resultadoParcial);
        operadores.splice(i, 1);
        i--;
      }
    }
  
    let resultado = numeros[0];

    for (let i = 0; i < operadores.length; i++) {
      let proximoNumero = numeros[i+1];
      switch (operadores[i]) {
        case '+':
          resultado += proximoNumero;
          break;
        case '-':
          resultado -= proximoNumero;
          break;
      }
    }
  
    // Retorna o resultado
    return resultado;
  }
  

let expressao = "25/100x100+5";
let resultado = calcularExpressao(expressao);
console.log({resultado});
