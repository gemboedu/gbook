
((w,d,c)=>{
    let urlBase = 'http://localhost/gbook/backend/gbookapi/';
/*     function getAllUsers(){
        let table = '';
        let url = 'http://localhost/gbook/backend/gbookapi/users.php?apicall=users';
        fetch(url)
        .then(response => response.json())
        .then(data =>{
            //debugger;
            if (!data.error) {
                let showTable = d.getElementById('table');
                let users = data.data;
                users.forEach(user => {
                    table += `${'Nombre: '+user.name + 
                    '<br>Email: '+ user.email + 
                    '<br>Fecha de registro: '+user.registed_at +'<br><br>'}`;
                });
                c(table);
                c(users);
                showTable.innerHTML = table;
            }else{
                c(data.msg);
            }
        })
        .catch(error => {
            c(error);
        })
    } */

    // @!mariela89tr$%

    async function load(){

        let table = '';

        async function getData(url){
            const getData = await fetch(url);
            const data = await getData.json();
            return data;
        }

        const usersList = await getData(urlBase+'users.php?apicall=users');
        setTimeout(()=>{

            if (!usersList.err) {
                let showTable = d.getElementById('table');
                let users = usersList.data;
                users.forEach(user => {
                    table += `
                    <tr id="${user.id}">
                        <td>${user.name}</td>
                        <td>${user.email}</td>
                        <td>${user.registed_at}</td>
                    </tr>
                    `;
                });
                showTable.innerHTML = table;
            }else{
                c(usersList.msg);
            }

        },3000);   
    }

    load();


})(window,document,console.log);