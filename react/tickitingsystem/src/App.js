// import logo from './logo.svg';
import './App.css';
import { useEffect, useState } from "react";

function App() {
  // Create state to hold the tickets data
  const [tickets, setTickets] = useState([]);

  // Fetch data from your PHP endpoint
  function fetchTickets() {
    fetch("http://localhost/tickets.php")
      .then((response) => response.json())
      .then((data) => {
        console.log("Tickets data:", data);
        setTickets(data); // Store data in state
        console.log("Tickets state:", tickets);
      })
      .catch((error) => {
        console.error("Error fetching tickets:", error);
      });
  }

  function addTicket() {
    // Logic to add a new ticket
    console.log("Add Ticket button clicked");
  }
  
  useEffect(() => {
    fetchTickets();
  }, []);

  // Display the tickets in a table
  return (
    <div className="App">
      <header className="App-header">
        <h1>Ticketing System</h1>
      </header>

      <table className="ticket-table">
        <thead>
          <tr>
            <th>Ticket No</th>
            <th>Parties</th>
            <th>Categories</th>
            <th>Updated</th>
            <th>Messages</th>
            <th>Status</th>
          </tr>
        </thead>

        <tbody>
          {tickets.map((ticket) => (
            <tr key={ticket.id}>
              <td>{ticket.id}</td>
              <td>{ticket.parties}</td>
              <td>{ticket.categories}</td>
              <td>{ticket.Updated}</td>
              <td>{ticket.messages}<button onClick={addTicket}>+</button></td>
              <td>{ticket.status}<button>Change</button></td>
            </tr>
          ))}
        </tbody>
      </table>
      <button>+</button>
    </div>
  );
}

export default App;

