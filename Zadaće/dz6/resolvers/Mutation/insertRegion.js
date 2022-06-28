const { GraphQLString } = require('graphql');
const { dbQuery } = require('../../database');
const RegionType = require('../../types/Region');

const insertRegion = {
    type: RegionType,
    args: {
        RegionID: { type: GraphQLString },
        RegionDescription: { type: GraphQLString }
    },
    async resolve(_, { RegionID, RegionDescription }) {
        let res = await dbQuery(`insert into region (RegionID, RegionDescription) values ('${RegionID}', '${RegionDescription}')`);
        return { RegionID, RegionDescription }
    }
};

module.exports = insertRegion;