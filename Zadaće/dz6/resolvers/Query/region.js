const { GraphQLInt } = require('graphql');
const { dbQuery } = require('../../database');
const RegionType = require('../../types/Region');

const fieldsRegion = {
    type: RegionType,
    args: {
        RegionID: { type: GraphQLInt }
    },
    async resolve(_, { RegionID }) {
        let res = await dbQuery(`SELECT * FROM region WHERE RegionID = ${RegionID}`);
        return res[0];
    }
};

module.exports = fieldsRegion;
