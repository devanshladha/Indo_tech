const members = [
    { name: "Devansh Ladha", role: "President" },
    { name: "Aayush Rathodiya", role: "Vice President" },
    { name: "Naman Soni", role: "Secretary" }
    // Add more members as needed
];

const events = [
    { title: "Community Quiz", date: "2025-01-15" },
    { title: "Volunteer Day", date: "2025-02-20" },
    { title: "Art Exhibition", date: "2025-04-10" }
    // Add more events as needed
];

const groups = [
    { name: "Design Club", description: "Learn about the world of design." },
    { name: "Yoga Group", description: "Weekly yoga sessions." },
    { name: "Art Club", description: "Learn the art of India." }
    // Add more groups as needed
];

function loadMembers() {
    const memberList = document.querySelector('.member-list');
    members.forEach(member => {
        const memberDiv = document.createElement('div');
        memberDiv.classList.add('member');
        memberDiv.innerHTML = `<h3>${member.name}</h3><p>${member.role}</p>`;
        memberList.appendChild(memberDiv);
    });
}

function loadEvents() {
    const eventList = document.querySelector('.event-list');
    events.forEach(event => {
        const eventDiv = document.createElement('div');
        eventDiv.classList.add('event');
        eventDiv.innerHTML = `<h3>${event.title}</h3><p>${event.date}</p>`;
        eventList.appendChild(eventDiv);
    });
}

function loadGroups() {
    const groupList = document.querySelector('.group-list');
    groups.forEach(group => {
        const groupDiv = document.createElement('div');
        groupDiv.classList.add('group');
        groupDiv.innerHTML = `<h3>${group.name}</h3><p>${group.description}</p>`;
        groupList.appendChild(groupDiv);
    });
}

window.onload = function() {
    loadMembers();
    loadEvents();
    loadGroups();
};
