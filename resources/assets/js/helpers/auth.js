import {setAuthorization} from './help'

export  function login(formData) {
return new Promise((res, rej) => {
    axios.post('/api/auth/login', formData)
          .then(resp => {
            setAuthorization(resp.data.access_token);
            res(resp.data)
          }).catch((err) =>{
            rej("Wrong email or password");
        })
})
}

export function register(formData) {
  return  new Promise((res, rej) => {
    axios.post('/api/register', formData).then(resp => {
   //  setAuthorization(resp.data.access_token);
      res(resp.data);
    }).catch(err => {
      rej(err)})
})
}

