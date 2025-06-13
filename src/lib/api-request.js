// URL de base de l'API
const API_BASE_URL = 'http://lien/api';

export async function postRequest(endpoint, data) {
  try {
    const response = await fetch(`${API_BASE_URL}${endpoint}`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(data),
    });
    console.log("data"+data)
    if (!response.ok) {
      throw new Error(`Erreur lors de l'envoi des données : ${response.statusText}`);
    }

    return await response.json();
  } catch (error) {
    console.error('Erreur lors de la requête POST :', error);
    throw error;
  }
}
