const cats = [
    {
        name: 'Charlie',
        adoptionStatus: 'available'
    },
    {
        name: 'Lily',
        adoptionStatus: 'not-available'
    },
    {
        name: 'Coco',
        adoptionStatus: 'available'
    },
    {
        name: 'Oreo',
        adoptionStatus: 'not-available'
    },
    {
        name: 'Luna',
        adoptionStatus: 'available'
    },
    {
        name: 'Milo',
        adoptionStatus: 'available'
    },
    {
        name: 'Lola',
        adoptionStatus: 'not-available'
    },
    {
        name: 'Leo',
        adoptionStatus: 'available'
    },
    {
        name: 'Willow',
        adoptionStatus: 'available'
    },
    {
        name: 'Bella',
        adoptionStatus: 'not-available'
    },
    {
        name: 'Max',
        adoptionStatus: 'available'
    },
    {
        name: 'Cleo',
        adoptionStatus: 'available'
    },
    {
        name: 'Lucy',
        adoptionStatus: 'not-available'
    },
    {
        name: 'Daisy',
        adoptionStatus: 'available'
    },
];

const cat = {name:"Pinecone", age:13, type:'Munchkin', cuteness: 9001};

// Question 6

let availableCats = [];
for (let i = 0; i < cats.length; i++) {
    if (cats[i].adoptionStatus === 'available') {
        availableCats.push(cats[i].name); 
    }
}

let availableCatsStr = "The cats available for adoption are: " + availableCats.join(", ") + "!"; 
console.log(availableCatsStr);

// Question 7
const randomValue = Math.random() * 10;
const message = randomValue > 5 ? "greater than five!" : "less than five!";
console.log(`Random value is ${randomValue}, which is ${message}`);

// Question 8
for (const key in cat) {
    console.log(cat[key]);
}

// Question 9
const num = 1;
const str = '1';

if (num == str) {
    console.log("1 == '1' is true");
}

if (num === str) {
    console.log("1 === '1' is true");
} else {
    console.log("1 === '1' is false");
}

// Question 10
const cuteCats = cats.map(cat => `${cat.name} is cute!`);
console.log(cuteCats);