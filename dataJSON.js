const payments = [
  { paymentID: '1', paymentMethod: 'Cash', validPayment: '1' },
  { paymentID: '2', paymentMethod: 'Check', validPayment: '1' },
  { paymentID: '3', paymentMethod: 'Bank card', validPayment: '1' },
  { paymentID: '4', paymentMethod: 'Bank transfer', validPayment: '1' },
];
const categories = [
  { categoryID: '1', category: 'Transportation', accountingID: '2' },
  { categoryID: '2', category: 'Scholarship', accountingID: '1' },
  { categoryID: '3', category: 'Meals & Lodging', accountingID: '1' },
  { categoryID: '4', category: 'Travel', accountingID: '2' },
  { categoryID: '5', category: 'Fuel', accountingID: '1' },
  { categoryID: '6', category: 'Phone bill', accountingID: '1' },
  { categoryID: '7', category: 'Entertainment', accountingID: '2' },
  { categoryID: '8', category: 'Investment', accountingID: '1' },
  { categoryID: '9', category: 'Clothing', accountingID: '2' },
  { categoryID: '10', category: 'Salary', accountingID: '2' },
];
const accountings = [
  { accountingID: '1', accountingType: 'Debit', accountingCoefficient: '-1' },
  { accountingID: '2', accountingType: 'Credit', accountingCoefficient: '1' },
];

export { payments, categories };
