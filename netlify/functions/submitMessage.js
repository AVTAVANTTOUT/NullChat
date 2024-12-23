// netlify/functions/submitMessage.js

const { MongoClient } = require('mongodb');

exports.handler = async (event, context) => {
  if (event.httpMethod === 'POST') {
    const body = JSON.parse(event.body);
    const message = body.message;
    
    // Remplace ces informations par celles de ta propre base de données
    const uri = "YOUR_MONGODB_URI"; // URI MongoDB Atlas ou autre base de données
    const client = new MongoClient(uri);

    try {
      await client.connect();
      const database = client.db('messagerie_anonyme');
      const collection = database.collection('messages');

      const result = await collection.insertOne({
        message: message,
        date: new Date()
      });

      return {
        statusCode: 200,
        body: JSON.stringify({ message: 'Message envoyé avec succès!' })
      };
    } catch (error) {
      return {
        statusCode: 500,
        body: JSON.stringify({ error: 'Erreur lors de l’envoi du message' })
      };
    } finally {
      await client.close();
    }
  }

  return {
    statusCode: 405,
    body: JSON.stringify({ error: 'Méthode non autorisée' })
  };
};
