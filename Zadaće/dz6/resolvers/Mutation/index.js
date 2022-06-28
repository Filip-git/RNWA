const { GraphQLObjectType } = require('graphql');
const insertRegion = require('./insertRegion');
const insertUser = require('./insertUser');

const Mutation = new GraphQLObjectType({
  name: 'mutation',
  fields: {
    // Insert a new user record
    insertUser: insertUser,
    //Insert new region
    insertRegion: insertRegion
  }
});

module.exports = Mutation;
