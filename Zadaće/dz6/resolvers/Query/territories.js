const { GraphQLList } = require('graphql');
const { dbQuery } = require('../../database');
const TerritoryType = require('../../types/Territory');

const fieldsTerritories = {
    type: new GraphQLList(TerritoryType),
    async resolve(_, { }) {
        let res = await dbQuery(`SELECT * FROM territories`);
        return res;
    }
};

module.exports = fieldsTerritories;
