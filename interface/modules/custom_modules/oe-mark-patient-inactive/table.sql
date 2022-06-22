CREATE TABLE IF NOT EXISTS `patient_status` (
    `statusId` int NOT NULL,
    `status` varchar(10) NOT NULL,
    `pid` bigint NOT NULL,
    `userId` varchar(10) NOT NULL,
    `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
    )  ENGINE = InnoDB COMMENT = 'Patient Status as active or in active';

-- Indexes for table `patient_status`
--
ALTER TABLE `patient_status`
ADD PRIMARY KEY (`statusId`),
ADD KEY `pid` (`pid`);
