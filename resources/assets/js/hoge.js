//require('axios');
import axios from 'axios';
console.log('hello masato');

axios.get('api/user')
 .then(function(response) {
  console.log(response);
 })

axios.get('api/user/55')
 .then(function(response) {
  console.log(response);
 })