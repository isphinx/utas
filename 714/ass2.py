#!/usr/bin/env python3

import csv

import numpy as np
from scipy import stats
import matplotlib.mlab as mlab
import matplotlib.pyplot as plt

file = open("a.csv", "r")
file.readline()

csvReader = csv.reader(file)

wf = open("result.csv", "w")
csvWriter = csv.writer(wf)
csvWriter.writerow(["", "T1 Result", "T2 Result", "T3 Result", "T4 Result"])


studentID = []
sex = []
nationality = []
t1Result = []
t2Result = []
t3Result = []
t4Result = []
sumResult = []
aveResult = []

result = {
    "studentID": [],
    "sex": [],
    "nationality": [],
    "t1Result": [],
    "t2Result": [],
    "t3Result": [],
    "t4Result": [],
}


# TODO t-test
# TODO anova
# TODO pearson correlation co-efficient
# TODO regresssion or multiple regression
# TODO data normality
# NOTE parametric and non-parametric test
# NOTE normal q plot w p-value


for item in csvReader:
    studentID.append(item[0])
    sex.append(item[1])
    nationality.append(item[2])
    t1Result.append(int(item[3]))
    t2Result.append(int(item[4]))
    t3Result.append(int(item[5]))
    t4Result.append(int(item[6]))
    sumR = int(item[3]) + int(item[4]) + int(item[5]) + int(item[6])
    sumResult.append(sumR)
    aveResult.append(sumR / 4)

    result["studentID"].append(item[0])
    result["sex"].append(item[1])
    result["nationality"].append(item[2])
    result["t1Result"].append(int(item[3]))
    result["t2Result"].append(int(item[4]))
    result["t3Result"].append(int(item[5]))
    result["t4Result"].append(int(item[6]))


print("sutdent ID:")
print(studentID)
print("sex:")
print(sex)
print("nationality:")
print(nationality)
print("t1Result:")
print(t1Result)
print("t2Result:")
print(t2Result)
print("t3Result:")
print(t3Result)
print("t4Result:")
print(t4Result)

t1max = np.max(t1Result)
t2max = np.max(t2Result)
t3max = np.max(t3Result)
t4max = np.max(t4Result)
csvWriter.writerow(["maximum", t1max, t2max, t3max, t4max])

t1min = np.min(t1Result)
t2min = np.min(t2Result)
t3min = np.min(t3Result)
t4min = np.min(t4Result)
csvWriter.writerow(["minimum", t1min, t2min, t3min, t4min])

t1mean = np.mean(t1Result)
t2mean = np.mean(t2Result)
t3mean = np.mean(t3Result)
t4mean = np.mean(t4Result)
csvWriter.writerow(["mean", t1mean, t2mean, t3mean, t4mean])

t1ave = np.sum(t1Result)
t2ave = np.sum(t2Result)
t3ave = np.sum(t3Result)
t4ave = np.sum(t4Result)
csvWriter.writerow(["sum", t1ave, t2ave, t3ave, t4ave])

t1var = round(np.var(t1Result), 3)
t2var = round(np.var(t2Result), 3)
t3var = round(np.var(t3Result), 3)
t4var = round(np.var(t4Result), 3)
csvWriter.writerow(["variance", t1var, t2var, t3var, t4var])


t1median = np.median(t1Result)
t2median = np.median(t2Result)
t3median = np.median(t3Result)
t4median = np.median(t4Result)
csvWriter.writerow(["median", t1median, t2median, t3median, t4median])

t1std = round(np.std(t1Result, ddof=1), 3)
t2std = round(np.std(t2Result, ddof=1), 3)
t3std = round(np.std(t3Result, ddof=1), 3)
t4std = round(np.std(t4Result, ddof=1), 3)
csvWriter.writerow(["deviation", t1std, t2std, t3std, t4std])

t1skw = round(stats.skew(t1Result), 3)
t2skw = round(stats.skew(t2Result), 3)
t3skw = round(stats.skew(t3Result), 3)
t4skw = round(stats.skew(t4Result), 3)
csvWriter.writerow(["skewness", t1skw, t2skw, t3skw, t4skw])

t1kur = round(stats.kurtosis(t1Result), 3)
t2kur = round(stats.kurtosis(t2Result), 3)
t3kur = round(stats.kurtosis(t3Result), 3)
t4kur = round(stats.kurtosis(t4Result), 3)
csvWriter.writerow(["kurtosis", t1kur, t2kur, t3kur, t4kur])

print(stats.ttest_ind(t1Result, t2Result))
print(stats.levene(t1Result, t2Result))
print(stats.ttest_rel(t1Result, t2Result))


# mu, sigma = 60, 10
# count, bins, ignored = plt.hist(aveResult, 20, normed=True)
# plt.plot(
#     bins,
#     1 / (sigma * np.sqrt(2 * np.pi)) * np.exp(-((bins - mu) ** 2) / (2 * sigma ** 2)),
#     linewidth=3,
#     color="y",
# )
# plt.xlabel("students")
# plt.ylabel("performance")
# plt.show()

# stats.probplot(t1Result, dist="norm", plot=plt)
# plt.show()


# all4semester = [t1Result, t2Result, t3Result, t4Result]
# plt.boxplot(
#     all4semester,
#     patch_artist=True,
#     labels=["T1 result", "T2 result", "T3 result", "T4 result"],
# )
# plt.xlabel("Terms")
# plt.ylabel("Results")
# plt.show()
