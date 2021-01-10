var polski = ['Konto', 'Wiek', 'Jabłko', 'Wolny', 'Owoc', 'Złoto', 'Głowa', 'Mięso', 'Pamięć', 'Specjalny'];
var angielski = ['Account', 'Age', 'Apple', 'Free', 'Fruit', 'Gold', 'Head', 'Meat', 'Memory', 'Special'];

const ileSlow = 10;
localStorage.setItem('max', ileSlow.toString());

function los() {
    var index = [];
    var go;

    for(var i = 0; i < ileSlow; i++) {
        do {
            go = false;
            index.push(Math.floor(Math.random() * ileSlow));

            for(var k = 0; k < i; k++) {
                if(index[i] === index[k]) {
                    go = true;
                    index.pop();
                }
            }
        } while(go);

        polski.push(polski[index[i]]);
        angielski.push(angielski[index[i]]);
    }
}