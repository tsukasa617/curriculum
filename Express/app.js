const express = require('express');
const app = express();
app.use(express.static('public'));
app.use(express.urlencoded({extended: false}));

const mysql = require('mysql');
const connection=mysql.createConnection({
  host: 'localhost',
  user: 'tsukasa',
  password: 'tsukasa617',
  database: 'Express'
});



app.get('/',(req,res)=>{
  res.render('top.ejs');
});

app.get('/send', (req, res) => {
  res.render('send.ejs');
});


app.get('/list', (req, res) => {
  connection.query(
    'SELECT * FROM items',
  (error,results)=>{
    console.log(results);
  res.render('list.ejs',{items:results});
});

});

app.post('/create', (req, res) => {
connection.query(
  'INSERT INTO items(titleName) VALUES(?)',
  [req.body.titleName],
  (error, results) => {
     res.redirect('/list');
      }
    );
}
);

app.post('/delete/:NO', (req, res) => {
  connection.query(
    'DELETE FROM items WHERE NO=?',
    [req.params.NO],
    (error,results)=>{
  res.redirect('/list');
    })
});

app.get('/edit/:NO',(req,res)=>{
  connection.query(
    'SELECT*FROM items WHERE NO=?',
    [req.params.NO],
    (error, results) => {
     res.render('edit.ejs',{item:results[0]});
    });
});

app.post('/update/:NO', (req, res) => {
  connection.query(
    'UPDATE items SET title=? WHERE NO=?',
    [req.body.titleName,req.params.NO],
    (error, results) => {
  res.redirect('/list');
    });
  });



app.listen(3000);
