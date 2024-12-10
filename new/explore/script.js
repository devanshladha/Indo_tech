
const facts = [
    {
        text: "Anti-Gravity Hill - The Magnetic Hill in Ladakh, India, is an intriguing natural wonder that seemingly defies the laws of gravity. Located on the Leh-Kargil-Baltic National Highway, this hill creates an optical illusion making it appear as though vehicles are rolling uphill against gravity when they are actually moving downhill. Still, tourists from around the world flock to the site to witness this phenomenon.",
        image: "src/hill.webp",
        likes: 0
    },
    {
        text: "Cows are sacred in India - The cow is considered sacred in the Hindu religion in India. They believe that each cow contains 330 million gods and goddesses. In ancient Hindu, the cow appears as 'Kamdhenu', which fulfills all desires. Its horns represent the ancient Hindu scriptures or the 'Vedas' and its udder, the four objectives of life: material wealth, salvation, and desire.",
        image: "src/cow.jpg",
        likes: 0
    },
    {
        text: "They are pioneers - As one of the oldest civilizations in the world, Indians gave the world a lot of important inventions and discoveries. You may not know, but chess is one of them. King Balhait ordered an Indian Brahmin to design a game to promote the intelligence of people.",
        image: "src/Chess- Indus.jpg",
        likes: 0
    },
    {
        text: "Yoga, a 5,000-year-old practice, originated in India and is now popular worldwide.",
        image: "src/yoga.jpg",
        likes: 0
    },
    {
        text: "India is the Bengal tiger capital of the world with 60% of the wild tiger population - India has 3,167 wild tigers, the only country with more than 1,000. India's tiger population accounts for 60% of all the remaining tigers worldwide. The Bengal tiger is India's national animal. The largest populations live in reserves like the Corbett Tiger Reserve and the Bandipur National Park in Karnataka.",
        image: "src/TIGER.webp",
        likes: 0
    },
    {
        text: "India produces 75 out of 109 recognized spice varieties - India produces 75 of the 109 varieties of spices listed by the International Organization for Standardization (ISO). With all that spice, it’s no wonder Indian cuisine is so popular worldwide. While some cuisines don’t use much more than salt and pepper, recipes for Indian food can include up to 15–20 different spices. The most produced and exported spices are pepper, cardamom, chili, ginger, turmeric, coriander, cumin, celery, fennel, fenugreek, garlic, nutmeg & mace, curry powder, spice oils, and oleoresins.",
        image: "src/SPICES.jpeg",
        likes: 0
    },
    {
        text: "The Kumbh Mela Festival in Northern India is the largest religious gathering in the world - The Kumbh Mela festival in Northern India is a popular pilgrimage in the Hindu religion that occurs once every 12 years and is attended by more than 100 million people over the 55-day festival. Before COVID, the 2019 Kumbh Mela in Prayagraj set a record with 200 million participants, 50 million of whom gathered on a single day.",
        image: "src/KHUMBH MELA.jpg",
        likes: 0
    }
];

function renderFact(fact) {
    const factBox = document.getElementById('fact-box');
    const factDiv = document.createElement('div');
    factDiv.classList.add('fact');

    const factText = document.createElement('p');
    factText.textContent = fact.text;

    const factImage = document.createElement('img');
    factImage.src = fact.image;
    factImage.alt = fact.text;

    const likeButton = document.createElement('button');
    likeButton.classList.add('like-button');
    likeButton.innerHTML = `<span class="material-symbols-outlined">thumb_up</span> ${fact.likes}`;
    likeButton.addEventListener('click', () => {
        fact.likes++;
        likeButton.innerHTML = `<span class="material-symbols-outlined">thumb_up</span> ${fact.likes}`;
        sortFacts();
        saveFacts();
        renderFacts();
    });
    factDiv.appendChild(factImage);
    factDiv.appendChild(factText);
    factDiv.appendChild(likeButton);

    factBox.appendChild(factDiv);

    // Apply the visible class for transition
    setTimeout(() => factDiv.classList.add('visible'), 100);
}

function renderFacts() {
    const factBox = document.getElementById('fact-box');
    factBox.innerHTML = '';
    facts.forEach(fact => renderFact(fact));
}

function saveFacts() {
    localStorage.setItem('facts', JSON.stringify(facts));
}

function loadFacts() {
    const savedFacts = localStorage.getItem('facts');
    return savedFacts ? JSON.parse(savedFacts) : null;
}

function sortFacts() {
    facts.sort((a, b) => b.likes - a.likes);
}

window.onload = function() {
    let savedFacts = loadFacts();
    if (!savedFacts) {
        saveFacts();
    } else {
        for (let i = 0; i < facts.length; i++) {
            facts[i].likes = savedFacts[i].likes;
        }
    }
    sortFacts();
    renderFacts();
};
