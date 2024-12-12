// config.js

// Calculators are defined as PHP classes.

var calcTheme = {
  fiType: "bank",
  primaryColor: "#291F78",
  primaryText: "",
  secondaryColor: "",
  secondaryText: "",
  icon: "/custom/_templateSECONDBranch/calculators/local/images/icon.png",
};

var rewardChecking = {
  type: "reward-checking",
  name: "Reward Checking Calculator",
  tier1Rate: ".0310",
  tier1Cap: "25000",
  tier2Rate: ".0101",
  maxAtmRefunds: "20",
  averageAtmFee: "3.00",
  learnMoreLink: "/personal/checking/reward-checking.php",
  questionsLink: "/about-us/contact-us.php",
};

var buyVsLease = {
  type: "buy-vs-lease",
  learnMoreLink: "/personal-banking/personal-loans.php",
  questionsLink: "/about-us/contact-us.php",
};

var savingsGoal = {
  type: "savings-goal",
  learnMoreLink: "/personal-banking/savings",
  questionsLink: "/about-us/contact-us.php",
  ratesLink: "/rates.php",
};

var cd = {
  type: "cd",
  learnMoreLink: "/personal-banking/savings",
  questionsLink: "/about-us/contact-us.php",
  ratesLink: "/rates.php",
};

var simpleLoan = {
  type: "simple-loan",
  learnMoreLink: "/personal-banking/personal-loans.php",
  questionsLink: "/about-us/contact-us.php",
  ratesLink: "/rates.php",
};

var mortgageLoan = {
  type: "mortgage-loan",
  learnMoreLink: "/personal-banking/personal-loans.php",
  questionsLink: "/about-us/contact-us.php",
  disclosuresLink: "/disclosures.php",
  ratesLink: "/rates.php",
};

var calcList = [
  rewardChecking,
  buyVsLease,
  savingsGoal,
  cd,
  simpleLoan,
  mortgageLoan,
];
